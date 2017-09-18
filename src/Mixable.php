<?php

namespace SirCumz\LaravelMixable;

use Illuminate\Filesystem\Filesystem;
use Closure;

class Mixable {

    protected $files;

    protected $less = [];

    protected $sass = [];

    protected $styles = [];

    protected $scripts = [];

    protected $js = [];

    protected $stylus = [];

    protected $react = [];

    protected $babel = [];

    protected $combine = [];

    protected $minify = [];

    protected $copy = [];

    protected $copyDirectory = [];

    protected $options = [];    

    protected $sourcemaps = false;

    protected $version = false;

    protected $notifications = true;

    protected $publicPath = null;

    protected $resourceRoot = null;

    protected $webpackConfig = [];

    protected $preprocessors = [];

    protected $callbacks = []; 

    /**
     * Create a new Mixable instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct( Filesystem $files )
    {
        $this->files = $files;
    }

    /**
     * Register files that should be mixed.
     * Closure function receives this instance as the first parameter
     * from there you are able to call almost any method that Laravel Mix provides.
     *
     * @param  closure  $closure
     * @return void
     */
    public function mix( Closure $closure )
    {
        $this->callbacks[] = $closure;
    }

    /**
     * Register Less compilation.
     *
     * @param string $input
     * @param string $output
     * @param array $options
     */
    public function less( $input, $output, $options = null )
    {
        $this->less[] = [$input, $output, $options];

        return $this;
    }   

    /**
     * Register Sass compilation.
     *
     * @param string $input
     * @param string $output
     * @param array $options
     */
    public function sass( $input, $output, $options = null )
    {
        $this->sass[] = [$input, $output, $options];

        return $this;
    }  

    /**
     * Register Stylus compilation.
     *
     * @param string $input
     * @param string $output
     * @param array $options
     */
    public function stylus( $input, $output, $options = null )
    {
        $this->stylus[] = [$input, $output, $options];

        return $this;
    }  

    /**
     * Alias for this->combine().
     *
     * @param string|Array $input
     * @param string $output
     */
    public function styles( $input, $output )
    {
        $this->styles[] = [$input, $output];

        return $this;
    }   

    /**
     * Alias for this->combine().
     *
     * @param string|Array $input
     * @param string $output
     */
    public function scripts( $input, $output )
    {
        $this->scripts[] = [$input, $output];

        return $this;
    }   

    /**
     * Register the Webpack entry/output paths.
     *
     * @param string|Array $input
     * @param string $output
     */
    public function js( $input, $output )
    {
        $this->js[] = [$input, $output];

        return $this;
    }   

    /**
     * Identical to this->combine(), but includes Babel compilation.
     *
     * @param string $input
     * @param string $output
     */
    public function babel( $input, $output )
    {
        $this->babel[] = [$input, $output];

        return $this;
    } 

    /**
     * Combine a collection of files.
     *
     * @param string|Array $input
     * @param string $output
     */
    public function combine( $input, $output )
    {
        $this->combine[] = [$input, $output];

        return $this;
    } 

    /**
     * Minify the provided file.
     *
     * @param string|Array $input
     */
    public function minify( $input )
    {
        $this->minify[] = $input;

        return $this;
    }    

    /**
     * Declare support for the React framework.
     *
     * @param string|Array $input
     * @param string $output     
     */
    public function react( $input, $output )
    {
        $this->react[] = [$input, $output];

        return $this;
    }    

    /**
     * Copy one or more files to a new location.
     *
     * @param string|Array $input
     * @param string $output
     * @param boolean $flatten
     */
    public function copy( $input, $output, $flatten = true )
    {
        $this->copy[] = [$input, $output, $flatten];

        return $this;
    }  

    /**
     * Copy an entire directory to a new location.
     *
     * @param string $input
     * @param string $output
     */
    public function copyDirectory( $input, $output )
    {
        $this->copyDirectory[] = [$input, $output];

        return $this;
    } 

    /**
     * Set Mix-specific options.
     *
     * @param array $options
     */
    public function options( $options )
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }            

    /**
     * Enable sourcemap support.
     */
    public function sourceMaps() {
        $this->sourcemaps = true;

        return $this;
    }

    /**
     * Enable compiled file versioning.
     *
     * @param string|Array $input
     */
    public function version($input = []) {
        $this->version = $input;

        return $this;
    }

    /**
     * Disable all OS notifications.
     */
    public function disableNotifications() {
        $this->notifications = false;

        return $this;
    }

    /**
     * Set the path to your public folder.
     *
     * @param string $path
     */
    public function setPublicPath($path) {
        $this->publicPath = $path;

        return $this;
    }

    /**
     * Set prefix for generated asset paths
     *
     * @param string $path
     */
    public function setResourceRoot($path) {
        $this->resourceRoot = $path;

        return $this;
    }

    /**
     * Merge custom config with the provided webpack.config file.
     *
     * @param array config
     */
    public function webpackConfig($config) {
        $this->webpackConfig = $config;

        return $this;
    }

    /**
     * Register a generic CSS preprocessor.
     *
     * @param string $type
     * @param string $src
     * @param string $output
     * @param array $pluginOptions
     */
    public function preprocess($type, $src, $output, $pluginOptions) {
        $this->preprocessors[] = [$type, $src, $output, $pluginOptions];

        return $this;
    }

    /**
     * Exports the manifest
     *
     */
    public function export()
    {
        $output = '';

        foreach( $this->callbacks as $callback )
        {
            $callback($this);
        }

        foreach( $this->less as $arr )
        {
            $output.= '.less("'.$this->escapePath($arr[0]).'", "'.$arr[1].'"'.$this->formatOptions($arr[2]).')';
        }

        foreach( $this->sass as $arr )
        {
            $output.= '.sass("'.$this->escapePath($arr[0]).'", "'.$arr[1].'"'.$this->formatOptions($arr[2]).')';
        }   

        foreach( $this->stylus as $arr )
        {
            $output.= '.stylus("'.$this->escapePath($arr[0]).'", "'.$arr[1].'"'.$this->formatOptions($arr[2]).')';
        }   

        foreach( $this->styles as $arr )
        {
            $output.= '.styles('.$this->escapeInput($arr[0]).', "'.$arr[1].'")';
        }  

        foreach( $this->js as $arr )
        {
            $output.= '.js('.$this->formatInput($arr[0]).', "'.$arr[1].'")';
        }   

        foreach( $this->react as $arr )
        {
            $output.= '.react('.$this->escapeInput($arr[0]).', "'.$arr[1].'")';
        } 

        foreach( $this->scripts as $arr )
        {
            $output.= '.scripts('.$this->escapeInput($arr[0]).', "'.$arr[1].'")';
        }  

        foreach( $this->babel as $arr )
        {
            $output.= '.babel('.$this->escapeInput($arr[0]).', "'.$arr[1].'")';
        }  

        foreach( $this->combine as $arr )
        {
            $output.= '.combine('.$this->escapeInput($arr[0]).', "'.$arr[1].'")';
        }  

        foreach( $this->minify as $src )
        {
            $output.= '.minify("'.$this->escapePath($src).'")';
        }   

        foreach( $this->copy as $arr )
        {
            $output.= '.copy('.$this->escapeInput($arr[0]).', "'.$arr[1].'", '.$arr[2].')';
        }     

        foreach( $this->copyDirectory as $arr )
        {
            $output.= '.copyDirectory('.$this->escapeInput($arr[0]).', "'.$arr[1].'")';
        }   

        if( count($this->options) )
        {
            $output.= '.options('.json_encode( (object) $this->options ).')';
        }   

        if( $this->sourcemaps )
        {
            $output.= '.sourcemaps()';
        }        

        if( is_array($this->version) )
        {
            $output.= '.version('.$this->escapeInput($this->version).')';
        }

        if( $this->notifications === false )
        {
            $output.= '.disableNotifications()';
        }        

        if( $this->publicPath )
        {
            $output.= '.setPublicPath('.$this->escapeInput($this->publicPath).')';
        }

        if( $this->resourceRoot )
        {
            $output.= '.setResourceRoot('.$this->escapeInput($this->resourceRoot).')';
        }        

        if( count($this->webpackConfig) )
        {
            $output.= '.webpackConfig('.$this->formatOptions($this->webpackConfig).')';
        }   

        foreach( $this->preprocessors as $processor )
        {
            $output.= '.preprocess("'.$processor[0].'",'.$this->escapeInput($processor[1]).', '.$this->escapeInput($processor[2]).', '.$this->formatOptions($processor[3]).')';
        }          

        if(strlen($output))
        {
            $output = 'mix' . $output . ';';
        }

        $stub = $this->files->get( __DIR__ . '/stubs/mixable.stub');

        $stub = str_replace('{$data}', $output, $stub);

        $this->files->put( dirname(dirname(__FILE__)) . '/mixable-manifest.js', $stub);                               
    }

    /**
     * Format an array of options to a json object.
     *
     * @param array $options
     */
    protected function formatOptions($options)
    {
        return ( !is_array($options) || !is_object($options) ) ? '' : ', ' . json_encode( (object) $options );
    }

    /**
     * Escape absolute url's (double back slashes etc) so it won't break webpack
     *
     * @param string|array $input
     */
    protected function escapeInput($input)
    {
        return (is_array($input) ? var_export($this->escapePath($input)) : '"'.$this->escapePath($input).'"');
    }  

    /**
     * Escape absolute url's (double back slashes etc) so it won't break webpack
     *
     * @param string $path
     */
    protected function escapePath($path)
    {
        if(is_string($path)) return addslashes($path);

        array_walk($path, function($item){
            return addslashes($item);
        });

        return $path;
    }    
}
