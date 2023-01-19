<?php


namespace App\Repository;

use App\Company;

class CompanyRepository extends RepositoryBase
{
    public function getById($id)
    {
    }

    public function getList($ids)
    {
    }

    public function create()
    {
    }

    public function update()
    {
    }

    public function delete($id)
    {
        Company::delete($id);
    }
}
