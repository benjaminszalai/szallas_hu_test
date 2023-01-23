<?php


namespace App\Repository;

use App\Company;

class CompanyRepository extends RepositoryBase
{
    public function getById($id)
    {
        return Company::where('companyId', '=', $id)->get();
    }

    public function getList($ids)
    {
        return Company::whereIn('companyId', $ids)->get();
    }

    public function create($company)
    {
        $newCompany = new Company();
        $newCompany->companyName = $company->companyName;
        $newCompany->companyRegistrationNumber = $company->companyRegistrationNumber;
        $newCompany->companyFoundationDate = $company->companyFoundationDate;
        $newCompany->country = $company->country;
        $newCompany->zipCode = $company->zipCode;
        $newCompany->city = $company->city;
        $newCompany->streetAddress = $company->streetAddress;
        $newCompany->latitude = $company->latitude;
        $newCompany->longitude = $company->longitude;
        $newCompany->companyOwner = $company->companyOwner;
        $newCompany->employees = $company->employees;
        $newCompany->activity = $company->activity;
        $newCompany->active = $company->active;
        $newCompany->email = $company->email;
        $newCompany->password = $company->password;

        try {
            $newCompany->save();
            $saveIsSuccess = true;
        } catch (\Exception $ex)
        {
            $saveIsSuccess = false;
            //TODO: log exception...
        }

        return $saveIsSuccess;
    }

    public function update($editCompanyData)
    {
        $company = $this->getById($editCompanyData->id);
        if(!$company) return false;

        foreach(get_object_vars($editCompanyData) as $k => $v) {
            if(!in_array($k, ['companyId', 'companyFoundationDate']) && property_exists($company, $k) && $v != '') {
                $company->$k = $v;
            }
        }

        try {
            $company->save();
            $saveIsSuccess = true;
        } catch (\Exception $ex)
        {
            $saveIsSuccess = false;
            //TODO: log exception...
        }

        return $saveIsSuccess;
    }

    public function delete($id)
    {
        throw new \Exception("Not implemented");
    }
}
