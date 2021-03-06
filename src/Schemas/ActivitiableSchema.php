<?php

namespace Amethyst\Schemas;

use Amethyst\Managers\ActivityManager;
use Railken\Lem\Attributes;
use Railken\Lem\Contracts\EntityContract;
use Railken\Lem\Schema;

class ActivitiableSchema extends Schema
{
    /**
     * Get all the attributes.
     *
     * @var array
     */
    public function getAttributes()
    {
        return [
            Attributes\IdAttribute::make(),
            Attributes\TextAttribute::make('relation')
                ->setDefault(function (EntityContract $entity) {
                    return 'default';
                }),
            Attributes\BelongsToAttribute::make('activity_id')
                ->setRelationName('activity')
                ->setRelationManager(ActivityManager::class)
                ->setRequired(true),
            \Amethyst\Core\Attributes\DataNameAttribute::make('activitiable_type')
                ->setRequired(true),
            Attributes\MorphToAttribute::make('activitiable_id')
                ->setRelationKey('activitiable_type')
                ->setRelationName('activitiable')
                ->setRelations(app('amethyst')->getDataManagers())
                ->setRequired(true),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}
