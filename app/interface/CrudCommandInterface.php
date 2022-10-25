<?php

interface CrudCommandInterface
{
    public function handle();

    public function buildController();

    // public function buildView();
}
