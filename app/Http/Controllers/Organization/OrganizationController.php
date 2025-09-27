<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\StoreOrganizationRequest;
use App\Http\Requests\Organization\UpdateOrganizationRequest;
use App\Models\Organization;
use App\Services\OrganizationService;
use Illuminate\Http\JsonResponse;

class OrganizationController extends Controller
{
    public function __construct(private OrganizationService $organizationService) {}

    public function index(): JsonResponse
    {
        $organizations = $this->organizationService->findAll();
        return response()->json($organizations);
    }

    public function store(StoreOrganizationRequest $request): JsonResponse
    {
        $data = $request->validated();
        $org = $this->organizationService->create($data['title']);

        return response()->json([
            'message' => 'Organização criada com sucesso!',
            'organization' => $org,
        ], 201);
    }

    public function show(Organization $organization): JsonResponse
    {
        return response()->json(
            $organization->load('owner', 'members')
        );
    }

    public function update(UpdateOrganizationRequest $request, Organization $organization): JsonResponse
    {
        $data = $request->validated();

        $ok = $this->organizationService->update($organization->id, $data['title']);

        if (! $ok) {
            return response()->json([
                'message' => 'Você não tem permissão para editar esta organização.',
            ], 403);
        }

        return response()->json([
            'message' => 'Organização atualizada com sucesso!',
            'organization' => $organization->fresh(),
        ]);
    }

    public function destroy(Organization $organization): JsonResponse
    {
        $ok = $this->organizationService->delete($organization->id);

        if (! $ok) {
            return response()->json([
                'message' => 'Você não tem permissão para remover esta organização.',
            ], 403);
        }

        return response()->json([
            'message' => 'Organização removida com sucesso!',
        ]);
    }
}
