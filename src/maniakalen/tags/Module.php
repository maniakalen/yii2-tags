<?php
/**
 * PHP Version 5.5
 *
 *  Yii2 Database translation module
 *
 * @category I18n
 * @package  Maniakalen_I18n
 * @author   Peter Georgiev <peter.georgiev@concatel.com>
 * @license  GNU GENERAL PUBLIC LICENSE https://www.gnu.org/licenses/gpl.html
 * @link     -
 */

namespace maniakalen\tags;

use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module as BaseModule;

/**
 * Class Module
 *
 *  Yii2 Database translation module definition.
 *
 * @category I18n
 * @package  Maniakalen_Tags
 * @author   Peter Georgiev <peter.georgiev@concatel.com>
 * @license  GNU GENERAL PUBLIC LICENSE https://www.gnu.org/licenses/gpl.html
 * @link     -
 */
class Module extends BaseModule implements BootstrapInterface
{

    /**
     * Module initialisation
     *
     * @return null
     * @throws \ErrorException
     */
    public function init()
    {
        if (defined('MANIAKALEN_TAGS')) {
            throw new \ErrorException("Trying to redefine translation module");
        }
        define('MANIAKALEN_TAGS', 1);
        Yii::setAlias('@maniakalen/tags', __DIR__);
        if (!$this->controllerNamespace) {
            $this->controllerNamespace = 'maniakalen\tags\controllers';
        }
        parent::init();

        if (isset($config['aliases']) && !empty($config['aliases'])) {
            Yii::$app->setAliases($config['aliases']);
        }
        return null;
    }

    /**
     * Overrides the default method in order to use the correct alias
     *
     * @return bool|string
     */
    public function getControllerPath()
    {
        return Yii::getAlias('@maniakalen/tags/controllers');
    }

    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param Application $app the application currently running
     *
     * @return null
     */
    public function bootstrap($app)
    {
        if (is_array($this->components) && !empty($this->components)) {
            $app->setComponents($this->components);
        }

        return null;
    }
}