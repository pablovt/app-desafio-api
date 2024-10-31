<?php

namespace App\Controller;

use App\Entity\Livro;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class LivroController extends AbstractController
{
    #[Route('/api/livros', name: 'livro_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        $livros = $em->getRepository(Livro::class)->findAll();
        $data = $serializer->serialize($livros, 'json');

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    #[Route('/api/livros', name: 'livro_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $livro = new Livro();
        $livro->setTitulo($data['titulo'] ?? null);
        $livro->setAutor($data['autor'] ?? null);
        $livro->setDescricao($data['descricao'] ?? null);
        $livro->setNumeroPaginas($data['numeroPaginas'] ?? null);
        $livro->setDataCadastro(new \DateTime($data['dataCadastro'] ?? 'now'));

        $em->persist($livro);
        $em->flush();

        $responseData = $serializer->serialize($livro, 'json');
        return new JsonResponse($responseData, Response::HTTP_CREATED, [], true);
    }

    #[Route('/api/livros/{id}', name: 'livro_show', methods: ['GET'])]
    public function show(Livro $livro, SerializerInterface $serializer): JsonResponse
    {
        $data = $serializer->serialize($livro, 'json');

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    #[Route('/api/livros/{id}', name: 'livro_update', methods: ['PUT'])]
    public function update(Request $request, Livro $livro, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $livro->setTitulo($data['titulo'] ?? $livro->getTitulo());
        $livro->setAutor($data['autor'] ?? $livro->getAutor());
        $livro->setDescricao($data['descricao'] ?? $livro->getDescricao());
        $livro->setNumeroPaginas($data['numeroPaginas'] ?? $livro->getNumeroPaginas());
        $livro->setDataCadastro(new \DateTime($data['dataCadastro'] ?? $livro->getDataCadastro()->format('Y-m-d')));

        $em->flush();

        $responseData = $serializer->serialize($livro, 'json');
        return new JsonResponse($responseData, Response::HTTP_OK, [], true);
    }

    #[Route('/api/livros/{id}', name: 'livro_delete', methods: ['DELETE'])]
    public function delete(Livro $livro, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($livro);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
