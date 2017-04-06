<?php
namespace JobBoard\Controllers;

use JobBoard\Job;
use JobBoard\Observer\EmailNotifier;
use JobBoard\Observer\PostJobOffer;

class JobController extends AbstractController
{
    public function showForm()
    {
        $html = $this->renderer->render('JobForm');
        $this->response->setContent($html);
    }

    public function postJobForm()
    {
        // Get input data
        $title = $this->request->get('title');
        $description = $this->request->get('description');
        $email = $this->request->get('email');

        // Validate the input

        // Create job instance
        $job = new Job($title, $description, $email, 1);

        $validator = $this->validator
            ->addMethodMapping('loadValidatorMetadata')
            ->getValidator();

        $violations = $validator->validate($job);
        if (count($violations) > 0) {

            // var_dump($violations); exit;
            $errorMessages = array();
            foreach ($violations as $violation) {
                $errorMessages[] = $violation->getMessage();
            }

            $data = [
                'errors' => $errorMessages
            ];
            $html = $this->renderer->render('JobForm', $data);
            $this->response->setContent($html);
            return;
        }


        // Create JobOffer instance and attach email notifier event to it
        $jobOffer = new PostJobOffer();
        $jobOffer->attach(new EmailNotifier());

        $data = "";
        // If job created successfully return success message
        if ($jobOffer->create($job)) {
            $data = [
                'message' => 'Job offer was saved'
            ];
        }
        // Send data to renderer to generate html output via templates
        $html = $this->renderer->render('JobForm', $data);
        // Send html to response
        $this->response->setContent($html);
    }

}