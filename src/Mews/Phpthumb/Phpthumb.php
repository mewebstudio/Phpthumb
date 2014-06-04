<?php namespace Mews\Phpthumb;

require_once __DIR__ . '/lib/ThumbLib.inc.php';

use View, Config, File;
use Illuminate\Config\Repository;
use Illuminate\View\Factory;

use PhpThumbFactory as Thumb;


/**
 *
 * Laravel 4 Phpthumb package
 * @copyright Copyright (c) 2013 MeWebStudio
 * @version 1.0.0
 * @author Muharrem ERİN
 * @contact me@mewebstudio.com
 * @link http://www.mewebstudio.com
 * @date 2013-03-21
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 *
 */

class Phpthumb {

    /**
     * Illuminate view environment.
     *
     * @var Illuminate\View\Factory
     */
    protected $view;

    /**
     * Illuminate config repository.
     *
     * @var Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Create a new Thumb instance.
     *
     * @param  Illuminate\View\Environment  $view
     * @param  Illuminate\Config\Repository  $config
     * @return void
     */
    public function __construct(Factory $view, Repository $config)
    {

        $this->view = $view;
        $this->config = $config;

    }

    /**
     * Create Image.
     *
     * @param  $file
     * @param  $width
     * @param  $height
     * @param  $type
     * @return object
     */
    public function create($perform, $args)
    {

        $this->file = $args[0];
        $this->filename = basename($this->file);
        $this->dirPath = rtrim($this->file, $this->filename);

        $this->thumb = Thumb::create($this->file);

        if ($perform == 'resize')
        {
            if ($args[3] == 'adaptive')
            {
                $this->thumb->adaptiveResize($args[1], $args[2]);
            }
            elseif ($args[3] == 'percent')
            {
                $this->thumb->resizePercent($args[1]);
            }
            else
            {
                $this->thumb->resize($args[1], $args[2]);
            }
        }
        elseif ($perform == 'crop')
        {
            if ($args[1] == 'center')
            {
                $this->thumb->cropFromCenter($args[2], $args[3]);
            }
            else
            {
                $this->thumb->crop($args[2], $args[3], $args[4], $args[5]);
            }
        }
        else
        {
            // show original image :)
        }
        return $this;

    }

    /**
     * Rotate Image.
     *
     * @param  $val -> mixed
     * @param  $direction
     * @return object
     */
    public function rotate($args)
    {

        if ($args[0] = 'direction')
        {
            $this->thumb->rotateImage($args[1]);
        }
        elseif ($args[0] = 'degree')
        {
            $this->thumb->rotateImageNDegrees($args[1]);
        }

        return $this;

    }

    /**
     * Reflection Image.
     *
     * @params  $percent, $reflection, $white, $border, $borderColor
     * @return object
     */
    public function reflection($args)
    {

        $this->thumb->createReflection($args[0], $args[1], $args[2], $args[3], $args[4]);

        return $this;

    }

    /**
     * Show Image.
     *
     * @return object
     */
    public function show()
    {
        $this->thumb->show();
        return $this;

    }

    /**
     * Save Image.
     *
     * @param  $savePath
     * @param  $filename
     * @param  $format
     * @return object
     */
    public function save($savePath = null, $filename = null, $format = null)
    {

        $this->thumb->save(($savePath ? $savePath : $this->dirPath) . ($filename ? $filename : $this->filename), ($format ? $format : File::extension($this->filename)));
        return $this;

    }

}
