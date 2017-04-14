<?php declare(strict_types = 1);

namespace JobBoard\Controllers;

use JobBoard\Auth\Auth;
use JobBoard\Config\Config;
use JobBoard\Model\Job;
use JobBoard\Repositories\JobRepository;
use JobBoard\Template\Renderer;
use JobBoard\Validation\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class JobController
 *
 * @package JobBoard\Controllers
 */
class JobController extends AbstractController
{
    protected $jobRepository;

    public function __construct(
        Request $request,
        Response $response,
        Renderer $renderer,
        Validator $validator,
        Auth $auth,
        Config $config,
        JobRepository $jobRepository
    )
    {
        parent::__construct($request, $response, $renderer, $validator, $auth, $config);
        $this->jobRepository = $jobRepository;
    }

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
            $job = new Job($title, $description, $email, 1, $this->auth->getUser()->id);

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

            $data = array();

            // If job created successfully return success message
            if ($this->jobRepository->save($job)) {
                $data = [
                    'message' => 'Job offer was saved'
                ];
            }
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
            $html = "Error occurred";
        }

        $this->response->setContent($html);
    }

    public function markAsSpam($input)
    {
        $status = $this->changeStatus((int)$input['id'], -1);
        if ($status) {
            $html = "Marked as spam successfully";
        } else {
            $html = "Error occurred";
        }

        $this->response->setContent($html);
    }

    public function changeStatus(int $id, int $status) :bool
    {
        if ($this->auth->isManager()) {
            $jobMapper = $this->connection->connection->mapper('JobBoard\Model\Entity\JobEntity');

            $job = $jobMapper->first(['id' => $id]);

            if ($job) {
                $job->status = $status;
                $jobMapper->update($job);
                return true;
            }
        }
        return false;
    }
}
