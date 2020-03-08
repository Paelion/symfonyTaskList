<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TasksRepository")
 */
class Tasks
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
    private $name;


    /**
     * @ORM\Column(type="datetime")
     */
    private $deadline;

    /**
     * @ORM\Column(type="boolean")
     */
    private $state;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Users", inversedBy="listTasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TasksRepository;

    public function __construct()
    {
        $this->userId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function getDeadline(): ?\DateTimeInterface
{
    return $this->deadline;
}

    public function setDeadline(\DateTimeInterface $deadline): self
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getState(): ?Boolean
    {
        return $this->state;
    }

    public function setState(Boolean $state): self
    {
        $this->state = $state;

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

    public function getTaskId(): ?Tasks
    {
        return $this->taskId;
    }

    public function setTaskId(?Tasks $taskId): self
    {
        $this->taskId = $taskId;

        return $this;
    }

    public function getTasksRepository(): ?string
    {
        return $this->TasksRepository;
    }

    public function setTasksRepository(string $TasksRepository): self
    {
        $this->TasksRepository = $TasksRepository;

        return $this;
    }

    /**
     * @return Collection|Users[]
     */
    public function getListUsers(): Collection
    {
        return $this->listUsers;
    }

    public function addListUser(Tasks $listUser): self
    {
        if (!$this->listUsers->contains($listUser)) {
            $this->listUsers[] = $listUser;
            $listUser->setUserId($this);
        }

        return $this;
    }

}
