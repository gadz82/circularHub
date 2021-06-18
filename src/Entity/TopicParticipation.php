<?php

namespace App\Entity;

use App\Repository\TopicParticipationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TopicParticipationRepository::class)
 */
class TopicParticipation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Topic::class, inversedBy="topicParticipants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $topic;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="topicParticipants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userGroup;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $role;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTopic(): ?Topic
    {
        return $this->topic;
    }

    public function setTopic(?Topic $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    public function getUserGroup(): ?Group
    {
        return $this->userGroup;
    }

    public function setUserGroup(?Group $userGroup): self
    {
        $this->userGroup = $userGroup;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function __toString() : string
    {
        return $this->id." - ".$this->getUserGroup()->getTitle();
    }
}
