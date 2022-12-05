<?php

namespace App\Entity;

use App\Repository\PaiementEmailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Timestamp;

#[ORM\Entity(repositoryClass: PaiementEmailRepository::class)]
#[ORM\HasLifecycleCallbacks]
class PaiementEmail
{
    use Timestamp;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'paiementEmails')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\OneToMany(mappedBy: 'paiementEmail', targetEntity: DemandePaiement::class)]
    private $demandePaiements;

    public function __construct()
    {
        $this->demandePaiements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    /**
     * @return Collection|DemandePaiement[]
     */
    public function getDemandePaiements(): Collection
    {
        return $this->demandePaiements;
    }

    public function addDemandePaiement(DemandePaiement $demandePaiement): self
    {
        if (!$this->demandePaiements->contains($demandePaiement)) {
            $this->demandePaiements[] = $demandePaiement;
            $demandePaiement->setPaiementEmail($this);
        }

        return $this;
    }

    public function removeDemandePaiement(DemandePaiement $demandePaiement): self
    {
        if ($this->demandePaiements->removeElement($demandePaiement)) {
            // set the owning side to null (unless already changed)
            if ($demandePaiement->getPaiementEmail() === $this) {
                $demandePaiement->setPaiementEmail(null);
            }
        }

        return $this;
    }
}
