<?php


namespace App\Http\Controllers;

use App\Repository\CompanyRepository;
use Illuminate\Http\Request;


class CompanyApiController extends Controller
{
    /**
     * @var $repository CompanyRepository
     */
    private $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getById($id)
    {
        $companyData = $this->repository->getById($id);
        if (!$companyData)
        {
            return response()->json([ 'status' => 404], 404);
        }

        return response()->json($companyData, 200);
    }

    public function getList(Request $request)
    {
        $companyData = $this->repository->getList($request->ids);
        if (!$companyData)
        {
            return response()->json([ 'status' => 404], 404);
        }

        return response()->json($companyData, 200);
    }

    public function create(Request $request)
    {
        $company = $request->company;
        $company->password = $this->hashPassword($company->password);

        $isSuccess = $this->repository->create($company);
        $status = $isSuccess ? 200 : 500;

        return response()->json([ 'isSuccess' => $isSuccess], $status);
    }

    public function update(Request $request)
    {
        $company = $request->company;
        if(property_exists($company, "password") && $company->password != '')
        {
            $company->password = $this->hashPassword($company->password);
        }

        $isSuccess = $this->repository->update($company);
        $status = $isSuccess ? 200 : 500;

        return response()->json([ 'isSuccess' => $isSuccess], $status);
    }

    public function delete($id)
    {
        $this->repository->delete($id);
    }

    private function hashPassword($str)
    {
        //TODO: itt valamilyen módon kell hash...
        return $str;
    }
}
