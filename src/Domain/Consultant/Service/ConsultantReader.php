<?php

namespace App\Domain\Consultant\Service;

use App\Domain\Consultant\Data\ConsultantData;
use App\Domain\Consultant\Repository\ConsultantReaderRepository;
use UnexpectedValueException;

/**
 * Service.
 */
final class ConsultantReader
{
    /**
     * @var ConsultantReaderRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param ConsultantReaderRepository $repository The repository
     */
    public function __construct(ConsultantReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a user by the given user id.
     *
     * @param int $userId The user id
     *
     * @throws UnexpectedValueException
     *
     * @return ConsultantData The user data
     */
    public function getConsultantDetails(int $consultant_co_sistema, string $consultant_in_ativo, array $consultant_co_tipo_usuario): ConsultantData
    {
        // Validation
        if (empty($consultant_co_sistema)) {
            throw new UnexpectedValueException('Sistema required');
        }
        if (empty($consultant_in_ativo)) {
            throw new UnexpectedValueException('Ativo required');
        }
        if (empty($consultant_co_tipo_usuario)) {
            throw new UnexpectedValueException('Tipo Usuario required');
        }

        $consultants = $this->repository->getConsultantsByParams(
            $consultant_co_sistema,
            $consultant_in_ativo,
            $consultant_co_tipo_usuario
        );

        return $consultants;
    }
}
