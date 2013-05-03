<?php
class Translation
{
    protected $translator;

    public function __construct($translator)
    {
        $translator->trans('translation.one');

        $this->translator = $translator;
    }

    public function two() {
        $this->translator->trans('translation.two');
    }
}