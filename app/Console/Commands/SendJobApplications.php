<?php

namespace App\Console\Commands;

use App\Mail\DeveloperApplicationMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendJobApplications extends Command
{
    protected $signature = 'email:send-applications';
    protected $description = 'Send job applications to companies';

    public function handle()
    {
        $applications = [
            ['email' => 'hr@company1.com', 'company' => 'Company 1', 'vacancy' => 'Senior Laravel Developer'],
            ['email' => 'jobs@company2.com', 'company' => 'Company 2', 'vacancy' => 'Fullstack Developer'],
            ['email' => 'career@company3.com', 'company' => 'Company 3', 'vacancy' => 'Backend Developer'],
            // Add more as needed
        ];

        foreach ($applications as $application) {
            try {
                Mail::to($application['email'])
                    ->send(new DeveloperApplicationMail(
                        $application['company'],
                        $application['vacancy']
                    ));
                
                $this->info("Email sent to {$application['company']} ({$application['email']})");
                
                // Sleep to avoid rate limiting
                sleep(2);
                
            } catch (\Exception $e) {
                $this->error("Failed to send to {$application['company']}: " . $e->getMessage());
            }
        }

        return Command::SUCCESS;
    }
}