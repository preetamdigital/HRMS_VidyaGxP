<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateCompanySettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('company.company_name','Life Link Digital');
        $this->migrator->add('company.contact_person','Amit Guru');
        $this->migrator->add('company.address','3864 Quiet Valley Lane, Sherman Oaks, CA, 91403');
        $this->migrator->add('company.country','India');
        $this->migrator->add('company.city','Indore');
        $this->migrator->add('company.province','California');
        $this->migrator->add('company.postal_code','0233');
        $this->migrator->add('company.email','amit@lifelinkdigital.com');
        $this->migrator->add('company.phone','233209229025');
        $this->migrator->add('company.mobile','233209229025');
        $this->migrator->add('company.fax','818-978-7102');
        $this->migrator->add('company.website_url','https://www.lifelinkdigital.com');
    }
}
