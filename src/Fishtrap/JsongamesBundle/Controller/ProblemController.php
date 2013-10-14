<?php

namespace Fishtrap\JsongamesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProblemController extends Controller
{

    public function startAction($problemSlug)
    {
    $key = 'sdso';
    $pepper = 'saltandpeppershere';
    $hash = md5(microtime().$pepper);

    $repository = $this->getDoctrine()
        ->getRepository('FishtrapJsongamesBundle:Problem');

    $problem = $repository->findOneByNumber($problemSlug);

    $finishUrl = $this->generateUrl(
            '_problem_finish',
            array(
                'problemSlug' => $problemSlug,
                'hash' => $hash
            )
    );

    return new JsonResponse(array(
        'description' => $problem->getDescription(),
        'message' => $problem->getQuestion(),
        'hash' => $hash,
        'finishUrl' => $finishUrl,
        ));
    }

    public function submitAction(Request $request, $problemSlug)
    {
        $repository = $this->getDoctrine()
            ->getRepository('FishtrapJsongamesBundle:Problem');

        $problem = $repository->findOneByNumber($problemSlug);

        $submited = $request->request->get('answer');
        if ($request->getMethod() == 'POST') {
            if ($problem->getAnswer() == $submited) {
                $response = new Response(
                '** Congratulations you have completed the event **',
                200,
                array()
                );
            } else {
                $response = new Response(
                    'Sorry wrong answer',
                    400,
                    array()
                    );
            }
        } else {
            $response = new Response(
                'POST method only supported',
                405,
                array()
            );
        }

        $response->prepare($request);
        return $response;

    }
}