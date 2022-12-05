<?php

namespace App\Entity;

use App\Repository\DemandePaiementRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Timestamp;

#[ORM\Entity(repositoryClass: DemandePaiementRepository::class)]
#[ORM\HasLifecycleCallbacks]
class DemandePaiement
{
    use Timestamp;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $montant;

    #[ORM\Column(type: 'string', length: 255)]
    private $typeVirement;

    #[ORM\Column(type: 'boolean')]
    private $statut;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'demandePaiements')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\ManyToOne(targetEntity: PaiementEmail::class, inversedBy: 'demandePaiements')]
    private $paiementEmail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getTypeVirement(): ?string
    {
        return $this->typeVirement;
    }

    public function setTypeVirement(string $typeVirement): self
    {
        $this->typeVirement = $typeVirement;

        return $this;
    }

    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPaiementEmail(): ?PaiementEmail
    {
        return $this->paiementEmail;
    }

    public function setPaiementEmail(?PaiementEmail $paiementEmail): self
    {
        $this->paiementEmail = $paiementEmail;

        return $this;
    }
}
