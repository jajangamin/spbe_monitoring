<?php

namespace App\Repositories\TransaksiBooking;
use App\Repositories\BaseRepository;

interface TransaksiBookingRepositoryInterface
{
    function status();
    function find(int $id);
    function search(string $field, int $id);
    function get();
    function list();
    function pagination(int $limit);
    function store($attributes);
    function update($id, $attributes);
    function toggle($attributes);

}