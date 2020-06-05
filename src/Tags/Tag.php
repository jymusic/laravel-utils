<?php

namespace JYmusic\Utils\Tags;

use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use Spatie\EloquentSortable\SortableTrait;
use Illuminate\Database\Eloquent\Collection as DbCollection;

class Tag extends Model implements Sortable
{
    use SortableTrait;

    public $translatable = ['name', 'slug'];

    public $guarded = [];

    public function scopeWithType(Builder $query, string $type = null): Builder
    {
        if (is_null($type)) {
            return $query;
        }

        return $query->where('type', $type)->orderBy('order_column');
    }

    public function scopeContaining(Builder $query, string $name): Builder
    {
        $locale = $locale ?? app()->getLocale();

        $locale = '"'.$locale.'"';

        return $query->whereRaw("LOWER(JSON_EXTRACT(name, '$.".$locale."')) like ?", ['"%'.strtolower($name).'%"']);
    }

    /**
     * @param array|\ArrayAccess $values
     * @param string|null $type
     * @param string|null $locale
     *
     * @return \Spatie\Tags\Tag|static
     */
    public static function findOrCreate($values, string $type = null)
    {
        $tags = collect($values)->map(function ($value) use ($type) {
            if ($value instanceof Tag) {
                return $value;
            }

            return static::findOrCreateFromString($value, $type);
        });

        return is_string($values) ? $tags->first() : $tags;
    }

    public static function getWithType(string $type): DbCollection
    {
        return static::withType($type)->orderBy('order_column')->get();
    }

    public static function findFromString(string $name, string $type = null)
    {
        $locale = $locale ?? app()->getLocale();

        return static::query()
            ->where("name", $name)
            ->where('type', $type)
            ->first();
    }

    protected static function findOrCreateFromString(string $name, string $type = null): self
    {
        $tag = static::findFromString($name, $type);

        if (! $tag) {
            $tag = static::create([
                'name' => $name,
				'slug' => $this->parseSlug($name),
                'type' => $type,
            ]);
        }

        return $tag;
    }
	
	/**
     * 解析 slug
     *
     * @param  string  $val
     * @param  boolean $isAbbr
     *
     * @return string
     */
    function parseSlug($name)
    {
        // 判断是否是中文
        if (preg_match("/[\x7f-\xff]/", $val)) {
            $pinyin = new \Overtrue\Pinyin\Pinyin();
            return $pinyin->abbr($val);
        }
        return strtolower($val);
    }
}
