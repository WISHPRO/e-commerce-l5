<?php namespace app\Anto\domainLogic\interfaces;

interface ImageRepositoryInterface
{

    function assignUniqueName();

    function getImageAttribute($attribute);

    function getOriginalName();

    function processPath();

    function getOriginalPath();

    function extractDimensions();

    function create();

    function processImage();

    function diminish();
}