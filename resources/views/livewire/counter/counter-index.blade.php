<div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="page-title">Counter</h1>
                <button class="btn btn-sm btn-primary" wire:click.prevent="decrease">-</button>
                <span class="mx-5">{{$counter}}</span>
                <button class="btn btn-sm btn-primary" wire:click.prevent="increase">+</button>
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
</div>
