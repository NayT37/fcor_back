<?php

namespace App\Domain\Consultant\Repository;

use App\Domain\Consultant\Data\ConsultantData;
use DomainException;
use PDO;

/**
 * Repository.
 */
class ConsultantReaderRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get Consultant by the given Consultant id.
     *
     * @param int $ConsultantId The Consultant id
     *
     * @throws DomainException
     *
     * @return ConsultantData The Consultant data
     */
    public function getConsultantsByParams(int $consultant_co_sistema, string $consultant_in_ativo, array $consultant_co_tipo_usuario): ConsultantData
    {
        $sql = "SELECT id, Consultantname, first_name, last_name, email FROM Consultants WHERE co_sistema = :co_sistema AND in_ativo = :in_ativo AND co_tipo_usuario :co_tipo_usuario; ";
        //$sql = "SELECT * FROM Consultants";
        $statement = $this->connection->prepare($sql);
        $statement->execute(
            [
            'co_sistema' => $consultant_co_sistema,
            'in_ativo' => $consultant_in_ativo,
            'co_tipo_usuario' => $consultant_co_tipo_usuario
            ],
        );

        $row = $statement->fetch();

        if (!$row) {
            throw new DomainException(sprintf('Consultant not found: %s', $$consultant_co_sistema,
            $consultant_in_ativo,
            $consultant_co_tipo_usuario));
        }

        // Map array to data object
        $consultants[] = new ConsultantData();
        $consultants[]->id = (int)$row['consultant_id'];
        $consultants[]->name = (string)$row['name'];

        return $Consultant;
    }
}