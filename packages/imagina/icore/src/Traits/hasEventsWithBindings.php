<?php

namespace Imagina\Icore\Traits;

trait hasEventsWithBindings
{
    /**
     * Save event bindings
     *
     * @var array
     */
    public $eventBindings = [];

    /**
     * Boot trait method
     */
    public static function bootHasEventsWithBindings() {}

    //=== Catch fire model events with bindings

    /**
     * Re-write method to Fire the given event for the model.
     *
     * @param  array  $data
     * @return mixed
     */
    protected function fireModelEvent($event, $halt = true, array $bindings = [])
    {
        //Save Event bindings
        $this->eventBindings[$event] = $bindings;
        //fire parent method
        return parent::fireModelEvent($event, $halt);
    }

    /**
     * Get the event bindings by event name
     */
    public function getEventBindings(string $event)
    {
        //Add data to eventData
        if (array_key_exists($event, $this->eventBindings)) {
            return $this->eventBindings[$event];
        }

        //Default response
        return null;
    }

    //=== Register model events with bindings

    /**
     * Register event to moel was retrieved
     */
    public static function retrievedIndexWithBindings($callback)
    {
        static::registerModelEvent('retrievedIndexWithBindings', $callback);
    }

    /**
     * Register event to moel was retrieved
     */
    public static function retrievedShowWithBindings($callback)
    {
        static::registerModelEvent('retrievedShowWithBindings', $callback);
    }

    /**
     * Register event to before create model
     *
     * @param  \Closure|string  $callback
     */
    public static function creatingWithBindings($callback)
    {
        static::registerModelEvent('creatingWithBindings', $callback);
    }

    /**
     * Register event to after create model
     *
     * @param  \Closure|string  $callback
     */
    public static function createdWithBindings($callback)
    {
        static::registerModelEvent('createdWithBindings', $callback);
    }

    /**
     * Register event to before update model
     *
     * @param  \Closure|string  $callback
     */
    public static function updatingWithBindings($callback)
    {
        static::registerModelEvent('updatingWithBindings', $callback);
    }

    /**
     * Register event to after update model
     *
     * @param  \Closure|string  $callback
     */
    public static function updatedWithBindings($callback)
    {
        static::registerModelEvent('updatedWithBindings', $callback);
    }

    //=== Event handlers with bindings

    /**
     * Method to fire event when model was retrieved
     */
    public function retrievedIndexCrudModel($bindings = [])
    {
        // fire custom event on the model
        $this->fireModelEvent('retrievedIndexWithBindings', false, $bindings);
    }

    /**
     * Method to fire event when model was retrieved
     */
    public function retrievedShowCrudModel($bindings = [])
    {
        // fire custom event on the model
        $this->fireModelEvent('retrievedShowWithBindings', false, $bindings);
    }

    /**
     * Method to fire event before create model
     */
    public function creatingCrudModel($bindings = [])
    {
        // fire custom event on the model
        $this->fireModelEvent('creatingWithBindings', false, $bindings);
    }

    /**
     * Method to fire event after create model
     */
    public function createdCrudModel($bindings = [])
    {
        // fire custom event on the model
        $this->fireModelEvent('createdWithBindings', false, $bindings);
    }

    /**
     * Method to fire event before update model
     */
    public function updatingCrudModel($bindings = [])
    {
        // fire custom event on the model
        $this->fireModelEvent('updatingWithBindings', false, $bindings);
    }

    /**
     * Method to fire event after update model
     */
    public function updatedCrudModel($bindings = [])
    {
        // fire custom event on the model
        $this->fireModelEvent('updatedWithBindings', false, $bindings);
    }
}
