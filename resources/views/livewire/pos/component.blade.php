<div>
    <style></style>

    <div class="row layout-top-spacing">
        <div class="col-sm-12 col-md-8">
            <!-- Detalles -->
            @include('livewire.pos.partials.detail')
        </div>

        <div class="col-sm-12 col-md-4">
            <!-- Total -->
            @include('livewire.pos.partials.total')

            <!-- Denominations -->
            @include('livewire.pos.partials.coins')
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/keypress.js@2.1.5/keypress.js"></script>
<script src="https://cdn.jsdelivr.net/npm/onscan.js@1.5.4/onscan.min.js"></script>
@include('livewire.pos.scripts.shortcuts')
@include('livewire.pos.scripts.events')
@include('livewire.pos.scripts.general')
@include('livewire.pos.scripts.scan')
