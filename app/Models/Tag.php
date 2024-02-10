<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 *
 * @package App\Models
 */
class Tag extends Model
{
    use HasFactory;

    public ?int $id = null;

    public string $label;

    public int $count;

    /**
     * Create model instance from array.
     */
    public static function fromArray(array $values): static
    {
        $self = new static();
        $self->id = $values['_id'] ?? $values['id'] ?? null;
        $self->label = $values['label'];
        $self->count = $values['count'];

        return $self;
    }
}
