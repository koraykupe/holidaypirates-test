<?php declare(strict_types = 1);

namespace JobBoard\Controllers;

use JobBoard\Job;
use JobBoard\Observer\EmailNotifier;
use JobBoard\Observer\PostJobOffer;

/**
 * Class JobController
 * @package JobBoard\Controllers
 */
class JobController extends AbstractController
{
    /**
     * Show add job form
     */
    public function showForm()
    {
        if (!$this->auth->getUser()) {
            $html = "Access Denied";
            $this->response->setStatusCode(401);
        } else {
            $html = $this->renderer->render('JobForm');
        }
        $this->response->setContent($html);
    }

    /**
     * Get input data and send it to create jobs db
     */
    public function postForm()
    {
        if (!$this->auth->getUser()) {
            $html = "Access Denied";
            // Send html to response
            $this->response->setContent($html);
        }

        // Get input data
        $title = $this->request->get('title');
        $description = $this->request->get('description');
        $email = $this->request->get('email');

        // Create job instance
        $job = new Job($title, $description, $email, 1);

        // Validate the input
        $validator = $this->validator
            ->addMethodMapping('loadValidatorMetadata')
            ->getValidator();

        $violations = $validator->validate($job);
        if (count($violations) > 0) {
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