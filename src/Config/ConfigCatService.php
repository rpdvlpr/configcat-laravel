<?php

namespace Rpdvlpr\Config;

use ConfigCat\User;
use ConfigCat\ConfigCatClient;
use ConfigCat\Cache\LaravelCache;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

/**
 * Service that provides access to the ConfigCat SDK.
 */
class ConfigCatService
{
    private $config;
    private $options;
    private $client;
    private $user;

    /**
     * Creates a new ConfigCatService.
     *
     * It uses the following options to instantiate the ConfigCatClient
     *     - logger: Laravel Logger.
     *     - cache: Laravel Cache Storage.
     * from the config file (config/configcat.php):
     *     - cache-refresh-interval: sets how frequent the cached configuration should be refreshed.
     *     - timeout: sets the http request timeout of the underlying http requests.
     *     - connect-timeout: sets the http connect timeout.
     */
    public function __construct() {
      $this->config = config('configcat');
      $this->options = [
        'logger'                 => Log::getFacadeRoot(),
        'cache'                  => new LaravelCache(Cache::store()),
        'cache-refresh-interval' => (int) $this->config['cache-refresh-interval'],
        'timeout'                => (int) $this->config['timeout'],
        'connect-timeout'        => (int) $this->config['connect-timeout'],
      ];

      $this->user = $this->_initUser();
      $this->client = new ConfigCatClient($this->config['api_key'], $this->options);
    }

    /**
     * Gets a value from the configuration identified by the given key.
     * User object is automatically appended for targeted values
     *
     * @param string $key The identifier of the configuration value.
     * @param mixed $defaultValue In case of any failure, this value will be returned.
     * @param User $user The (configcat) user object to identify the caller.
     *
     * @return mixed The configuration value identified by the given key.
     */
    public function getValue($key, $defaultValue = false)
    {


      return $this->client->getValue($key, $defaultValue, $this->user);
    }

    /**
     * Set up ConfigCat User for targeting
     * This method loads Laravel User data into ConfigCat User object.
     *
     * @return ConfigCat\User.
     */
    private function _initUser()
    {
      $authClass = $this->config['auth_class'];
      $authMethod = $this->config['auth_method'];
      $userIdentifier = $this->config['user_identifier'];
      $userMethod = $this->config['user_method'];
      $laravelUser = $authClass::$authMethod();

      if (is_null($laravelUser)) {
        // if there is no authenticated user use session id for targeting
        $userId = Session::getId();
        $userCustom = [];
      } else {
        $userId = $laravelUser->$userIdentifier;
        $userCustom = $laravelUser->$userMethod();
      }

      return new User($userId, '', '', $userCustom);
    }
}
