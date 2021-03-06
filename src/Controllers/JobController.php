<?php declare(strict_types = 1);

namespace JobBoard\Controllers;

use JobBoard\Model\Job;
use JobBoard\Observer\EmailNotifierForModerator;
use JobBoard\Observer\EmailNotifierForUser;

/**
 * Class JobController
 *
 * @package JobBoard\Controllers
 */
class JobController extends AbstractController
{
    /**
     * Show add job form
     */
    public function showForm()
    {
        $user = $this->auth->getUser();

        if (!$user) {
            $html = "Access Denied";
            $this->response->setStatusCode(401);
        } else {
            $data['email'] = $user->email;
            $html = $this->renderer->render('JobForm', $data);
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
            $this->response->setStatusCode(401);
        } else {
            // Get input data
            $title = $this->request->get('title');
            $description = $this->request->get('description');
            $email = $this->request->get('email');

            // Create job instance
            $job = new Job($title, $description, $email, $this->auth->getUser()->id);

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

            // Calculate user's past job posts and attach event

            if ($this->jobRepository->countUsersJobPosts(intval($job->user_id)) == 0) {
                $job->status = 0;
                // If this is first job posting of the user attach email notifier event
                $job->attach(new EmailNotifierForUser($job));
            } else {
                $job->status = 1;
            }

            // If job created successfully return success message
            try {
                $job = $this->jobRepository->create($job);
                $data = ['message' => 'Job offer was saved'];
            } catch (\Exception $exception) {
                throw $exception;
            }

            $job->attach(new EmailNotifierForModerator($job, $this->userRepository));
            $job->notify();

            // Send data to renderer to generate html output via templates
            $html = $this->renderer->render('JobForm', $data);
        }

        // Send html to response
        $this->response->setContent($html);
    }

    public function approve($input)
    {
        $status = $this->changeStatus((int)$input['id'], 1);
        if ($status) {
            $html = "Approved successfully";
        } else {
            $html = "Please login as manager";
        }

        $this->response->setContent($html);
    }

    public function markAsSpam($input)
    {
        $status = $this->changeStatus((int)$input['id'], -1);
        if ($status) {
            $html = "Marked as spam successfully";
        } else {
            $html = "Please login as manager";
        }

        $this->response->setContent($html);
    }

    public function changeStatus(int $id, int $status) :bool
    {
        if ($this->auth->isManager()) {
            $this->jobRepository->updateStatus($id, $status);
            return true;
        }
        return false;
    }
}
