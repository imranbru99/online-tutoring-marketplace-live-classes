<?php

declare(strict_types=1);

namespace App\Services\Tenancy;

use App\Modules\Core\Models\Branch;
use App\Modules\Core\Models\Business;
use Closure;

class TenantContext
{
    protected ?Business $business = null;

    protected ?Branch $branch = null;

    protected bool $isScopingDisabled = false;

    public function setBusiness(?Business $business): self
    {
        $this->business = $business;

        return $this;
    }

    public function getBusiness(): ?Business
    {
        return $this->business;
    }

    public function getBusinessId(): ?int
    {
        return $this->business?->id;
    }

    public function setBranch(?Branch $branch): self
    {
        $this->branch = $branch;

        return $this;
    }

    public function getBranch(): ?Branch
    {
        return $this->branch;
    }

    public function getBranchId(): ?int
    {
        return $this->branch?->id;
    }

    public function check(): bool
    {
        return $this->business !== null;
    }

    public function disableScoping(): self
    {
        $this->isScopingDisabled = true;

        return $this;
    }

    public function enableScoping(): self
    {
        $this->isScopingDisabled = false;

        return $this;
    }

    public function isScopingDisabled(): bool
    {
        return $this->isScopingDisabled;
    }

    public function runWithoutScoping(Closure $callback): mixed
    {
        $previous = $this->isScopingDisabled;
        $this->isScopingDisabled = true;

        try {
            return $callback();
        } finally {
            $this->isScopingDisabled = $previous;
        }
    }

    public function runWithTenant(Business $business, Closure $callback): mixed
    {
        $previousBusiness = $this->business;
        $previousBranch = $this->branch;

        $this->business = $business;

        try {
            return $callback($business);
        } finally {
            $this->business = $previousBusiness;
            $this->branch = $previousBranch;
        }
    }
}
