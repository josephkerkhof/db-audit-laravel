<?php

namespace JosephKerkhof\DbAudit\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use InvalidArgumentException;
use JosephKerkhof\DbAudit\Auditable;

class ModelResolver
{
    /**
     * Get the model class from a table name.
     *
     * @param  string  $table  The table name (e.g. 'users')
     * @return string The fully qualified model class name
     *
     * @throws InvalidArgumentException If the model cannot be resolved
     */
    public static function fromTable(string $table): string
    {
        // Convert table name to singular studly case (e.g., 'blog_posts' -> 'BlogPost')
        $modelName = Str::studly(Str::singular($table));

        // Look for the models in these locations
        $locations = config('db-audit.model_locations', []);
        foreach ($locations as $namespace) {
            $modelClass = trim($namespace, '\\').'\\'.$modelName;
            if (class_exists($modelClass) && is_subclass_of($modelClass, Model::class)) {
                return $modelClass;
            }
        }

        throw new InvalidArgumentException("Could not resolve model class for table '{$table}'");
    }

    /**
     * @param  class-string  $model  The model class to check if it implements the Auditable trait
     */
    public static function isAuditable(string $model): bool
    {
        if (! class_exists($model) || ! is_subclass_of($model, Model::class)) {
            return false;
        }

        $classTraits = class_uses_recursive($model);

        return in_array(Auditable::class, $classTraits);
    }
}
