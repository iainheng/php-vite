<?php

namespace mindplay\vite;

/**
 * This class represents a chunk of Vite's `manifest.json` file, which contains
 * records of all published files, their dependencies, and other metadata.
 *
 * @see https://github.com/vitejs/vite/blob/e7adcf0878bd7f3c0b7bb5c9a1d7e6f0d55d9650/packages/vite/src/node/plugins/manifest.ts#L18-L28
 */
class Chunk
{
    public ?string $src;

    /**
     * Logical chunk name, as defined by Rollup.
     *
     * Only defined for chunks that are entry points.
     *
     * Vite's `build.rollupOptions.input` setting affects this value - you
     * can define a custom chunk name for each entry point by using an
     * object instead of an array.
     *
     * @link https://rollupjs.org/configuration-options/#input
     */
    public ?string $name;

    /**
     * Indicates whether this chunk is an entry point.
     */
    public bool $isEntry;

    /**
     * Indicates whether this chunk is a dynamic entry point.
     */
    public bool $isDynamicEntry;

    /**
     * Path to the published file, relative to Vite's `build.outDir`.
     */
    public string $file;

    /**
     * Paths to published CSS files imported by this chunk,
     * relative to Vite's `build.outDir`.
     *
     * @var string[]
     */
    public array $css;

    /**
     * Paths to published assets imported by this chunk,
     * relative to Vite's `build.outDir`.
     *
     * @var string[]
     */
    public array $assets;

    /**
     * List of chunk names of other chunks (statically) imported by this chunk.
     *
     * @var string[]
     */
    public array $imports;

    /**
     * Links of chunk names of other chunks (dynamically) imported by this chunk.
     *
     * @var string[]
     */
    public array $dynamicImports;

    public function __construct(
        ?string $src,
        ?string $name,
        bool $isEntry,
        bool $isDynamicEntry,
        string $file,
        array $css,
        array $assets,
        array $imports,
        array $dynamicImports
    ) {
        $this->name = $name;
        $this->src = $src;
        $this->isEntry = $isEntry;
        $this->isDynamicEntry = $isDynamicEntry;
        $this->file = $file;
        $this->css = $css;
        $this->assets = $assets;
        $this->imports = $imports;
        $this->dynamicImports = $dynamicImports;
    }

    public static function create(array $chunk): self
    {
        return new self(
            $chunk['src'] ?? null,
            $chunk['name'] ?? null,
            $chunk['isEntry'] ?? false,
            $chunk['isDynamicEntry'] ?? false,
            $chunk['file'],
            $chunk['css'] ?? [],
            $chunk['assets'] ?? [],
            $chunk['imports'] ?? [],
            $chunk['dynamicImports'] ?? [],
        );
    }
}
