<?php
/**
 * Object Cache
 * @uses wp cache functions
 * @uses Cacheable Interface
 */

namespace underDEV\Utils\Cache;
use underDEV\Utils\Interfaces\Cacheable;

/**
 * Object cache
 */
class Object implements Cacheable {

	/**
	 * Cache unique key
	 * @var string
	 */
	protected $key;

	/**
	 * Cache group
	 * @var string
	 */
	protected $group;

	/**
	 * Constructor
	 * @param string $key   cache unique key
	 * @param string $group cache group, optional
	 */
	public function __construct( $key, $group = '' ) {

		if ( empty( $key ) ) {
			trigger_error( 'Cache key cannot be empty' );
		}

		$this->key   = $key;
		$this->group = $group;

	}

	/**
	 * Sets cache value
	 * @param mixed   $value value to store
	 * @return object $this
	 */
	public function set( $value ) {
		wp_cache_set( $this->key, $value, $this->group );
		return $this;
	}

	/**
	 * Adds cache if it's not already set
	 * @param mixed   $value value to store
	 * @return object $this
	 */
	public function add( $value ) {
		wp_cache_add( $this->key, $value, $this->group );
		return $this;
	}

	/**
	 * Gets value from cache
	 * @param  boolean $force not used, transients are always get from storage
	 * @return mixed          cached value
	 */
	public function get( $force = false ) {
		return wp_cache_get( $this->key, $this->group, $force );
	}

	/**
	 * Deletes value from cache
	 * @return object $this
	 */
	public function delete() {
		wp_cache_delete( $this->key, $this->group );
		return $this;
	}

}
