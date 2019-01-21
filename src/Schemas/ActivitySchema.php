<?php

namespace Railken\Amethyst\Schemas;

use Illuminate\Support\Facades\Config;
use Railken\Lem\Attributes;
use Railken\Lem\Schema;

class ActivitySchema extends Schema
{
    /**
     * Get all the attributes.
     *
     * @var array
     */
    public function getAttributes()
    {
        $sourceableConfig = Config::get('amethyst.activity.data.activity.attributes.sourceable.options');

        return [
            Attributes\IdAttribute::make(),
            Attributes\TextAttribute::make('name')
                ->setRequired(true)
                ->setUnique(true),
            Attributes\LongTextAttribute::make('description'),
            Attributes\DateTimeAttribute::make('starts_at'),
            Attributes\DateTimeAttribute::make('ends_at'),
            Attributes\EnumAttribute::make('sourceable_type', array_keys($sourceableConfig))
                ->setRequired(true),
            Attributes\MorphToAttribute::make('sourceable_id')
                ->setRelationKey('sourceable_type')
                ->setRelationName('sourceable')
                ->setRelations($sourceableConfig)
                ->setRequired(true),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}
