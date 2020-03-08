<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_insc;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tasks", mappedBy="userId")
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $listTasks;
    private $UsersRepository;

    public function __construct()
    {
        $this->listTasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
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

    public function getDateInsc(): ?\DateTimeInterface
    {
        return $this->date_insc;
    }

    public function setDateInsc(\DateTimeInterface $date_insc): self
    {
        $this->date_insc = $date_insc;

        return $this;
    }

    public function getTaskId(): ?Tasks
    {
        return $this->taskId;
    }

    public function setTaskId(?Tasks $taskId): self
    {
        $this->taskId = $taskId;

        return $this;
    }

    public function getUserId(): ?Users
    {
        return $this->userId;
    }

    public function setUserId(?Users $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getUsersRepository(): ?string
    {
        return $this->UsersRepository;
    }

    public function setUsersRepository(string $UsersRepository): self
    {
        $this->UsersRepository = $UsersRepository;

        return $this;
    }

}
