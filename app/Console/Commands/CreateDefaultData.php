<?php

namespace App\Console\Commands;

use App\Models\DocumentType;
use App\Models\NewsType;
use App\Models\Permission;
use App\Models\Status;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDefaultData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:default-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $documentTypes = [
            "report",
            "document",
            "game-rules",
            "additional-rules",
            "circular"
        ];

        $status = [
            "published",
            "draft",
            "unpublished"
        ];

        $permissions = [
            'admin',
            'dcm',
            'competition-manager'
        ];

        $newsTypes = [
            'National-team-men-senior',
            'National-team-men-U-23-Olympic',
            'National-team-men-U-17',
            'National-team-men-other',
            'National-team-women-senior',
            'National-team-women-U-20',
            'National-team-women-other',
            'Grassroots-football',
            'Football-for-schools',
            'Youth-Development',
            'other'
        ];

        try {
            DB::transaction(function () use ($documentTypes, $status, $permissions, $newsTypes) {

                foreach ($documentTypes as $documentType) {
                    $type = DocumentType::where('name', $documentType)->first();

                    if (!is_null($type)) {
                        $this->error("DocumentType exist in Database");
                        return;
                    }

                    DocumentType::create([
                        "name" => $documentType
                    ]);
                }

                foreach ($status as $value) {
                    $stat = Status::where('name', $value)->first();
                    if (!is_null($stat)) {
                        $this->error("Status exist in Database");
                        return;
                    }

                    Status::create([
                        "name" => $value
                    ]);
                }

                foreach ($permissions as $value) {
                    $permission = Permission::where('name', $value)->first();
                    if (!is_null($permission)) {
                        $this->error("Permission exist in Database");
                        return;
                    }

                    Permission::create([
                        "name" => $value
                    ]);
                }

                foreach ($newsTypes as $value) {
                    $newsType = NewsType::where('name', $value)->first();
                    if (!is_null($newsType)) {
                        dump($newsType);
                        $this->error("NewsType exist in Database");
                        return;
                    }

                    NewsType::create([
                        'name' => $value
                    ]);
                }
            });
            $this->info('Default Data Inserted successfully');
        } catch (\Throwable $th) {
            $this->error("Contact Support");
        }
    }
}
