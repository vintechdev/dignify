<?php

namespace TypiCMS\Modules\Products\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Files\Traits\HasFiles;
use TypiCMS\Modules\History\Traits\Historable;
use TypiCMS\Modules\Products\Presenters\BrochureDetailsPresenter;

class BrochureDetail extends Base
{
    use HasFiles;
    use Historable;
    use PresentableTrait;

    protected $presenter = BrochureDetailsPresenter::class;

    protected $dates = [];

    protected $guarded = ['id', 'exit'];

    public function brochure(): BelongsTo
    {
        return $this->belongsTo(Brochure::class, 'brochure_id');
    }
}
