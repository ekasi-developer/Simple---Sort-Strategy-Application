<?php

namespace Simple;

use Exception;
use JetBrains\PhpStorm\Pure;
use Simple\Interfaces\ViewInterface;

class View extends HandleRequest implements ViewInterface
{
    /**
     * Application base path.
     *
     * @var string $directory
     */
    protected static string $directory;

    /**
     * Application compiled view directory.
     *
     * @var string $directory
     */
    protected static string $compiledDirectory;

    /**
     * View name.
     *
     * @var string $view
     */
    protected string $view;

    /**
     * View data.
     *
     * @var array
     */
    protected array $data;

    /**
     * BladeOne view class.
     *
     * @var BladeOne
     */
    protected BladeOne $blade;

    public function __construct(BladeOne $bladeOne, string $view, array $data = [])
    {
        $this->view = $view;
        $this->data = $data;
        $this->blade = $bladeOne;
    }

    public function view(): string
    {
        return $this->view;
    }

    public function data(string $key = null): mixed
    {
        return is_null($this->data)
            ? $this->data
            : $this->data[$key] ?? null;
    }

    public static function setDirectory(string $directory): void
    {
        View::$directory = $directory;
    }

    public static function setCompiledDirectory(string $directory): void
    {
        static::$compiledDirectory = $directory;
    }

    public static function make(string $view, array $data = []): ViewInterface
    {
        return new View(
            new BladeOne(static::$directory, static::$compiledDirectory, BladeOne::MODE_DEBUG),
            $view,
            $data
        );
    }

    public function handle(): void
    {
        if (file_exists($this->getViewFramework()))
        {
            $file = $this->getViewFramework(false);
        }
        elseif (file_exists($this->getViewApplication()))
        {
            $file = $this->getViewApplication(false);
        }
        else
        {
            throw new Exception("The {$this->view} view does not exists");
        }

        echo $this->blade->run($file, $this->data);
    }

    /**
     * Get framework view.
     *
     * @param bool $fullPath
     * @return string
     */
    #[Pure]
    protected function getViewFramework(bool $fullPath = true): string
    {
        return $fullPath ?
            "{$this->directory()}/vendor/Simple/Views/{$this->view}.blade.php" :
            "vendor/Simple/Views/{$this->view}";
    }

    /**
     * Get application view.
     *
     * @param bool $fullPath
     * @return string
     */
    #[Pure]
    protected function getViewApplication(bool $fullPath = true): string
    {
        return $fullPath ?
            "{$this->directory()}/Application/Views/{$this->view}.blade.php" :
            "Application/Views/{$this->view}";
    }

    /**
     * Get application directory.
     *
     * @return string
     */
    protected function directory(): string
    {
        return static::$directory;
    }
}