<?php

namespace App\Console\Commands;

use App\Mail\DeveloperApplicationMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ImportAndSendEmails extends Command
{
    protected $signature = 'email:import-send {file}';
    protected $description = 'Import emails from CSV and send applications';

    public function handle()
    {
        $filePath = $this->argument('file');
        
        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return Command::FAILURE;
        }

        $file = fopen($filePath, 'r');
        
        // Get headers
        $headers = fgetcsv($file);
        
        // Validate headers
        if (!$headers || !in_array('email', $headers) || !in_array('company', $headers)) {
            $this->error('CSV must contain "email" and "company" columns');
            fclose($file);
            return Command::FAILURE;
        }

        $success = 0;
        $failed = 0;

        while (($row = fgetcsv($file)) !== false) {
            $data = array_combine($headers, $row);
            
            try {
                Mail::to($data['email'])
                    ->send(new DeveloperApplicationMail(
                        $data['company'],
                        $data['vacancy'] ?? 'вакансию'
                    ));
                
                $success++;
                $this->info("Sent to {$data['email']}");
                
                // Sleep to avoid rate limiting
                sleep(2);
                
            } catch (\Exception $e) {
                $failed++;
                $this->error("Failed: {$data['email']} - {$e->getMessage()}");
            }
        }

        fclose($file);
        
        $this->info("Completed: {$success} sent, {$failed} failed");
        return Command::SUCCESS;
    }
}