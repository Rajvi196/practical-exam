<?php
namespace App\Repositories;


/**
 * Interface IDMRepository
 */

interface IdmMain
{
    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = []);


    /*
     * @param integer $id
     * @return mixed
     */
    public function find($id);


    /*
     * @param array $data
     * @return integer $id;
     */
    public function create(array $data);


    /*
     * @param integer $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data);


    /*
     * @param integer $id
     * @return mixed
     */
    public function delete($id);
} 