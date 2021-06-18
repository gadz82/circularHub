<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 */
class Group
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="groups")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=TopicParticipation::class, mappedBy="userGroup", orphanRemoval=true)
     */
    private $topicParticipations;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->topicParticipations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addGroup($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeGroup($this);
        }

        return $this;
    }

    public function __toString(){
        return $this->getId()." - ".$this->getTitle();
    }

    /**
     * @return Collection|TopicParticipation[]
     */
    public function getTopicParticipations(): Collection
    {
        return $this->topicParticipations;
    }

    public function addTopicParticipation(TopicParticipation $topicParticipant): self
    {
        if (!$this->topicParticipations->contains($topicParticipant)) {
            $this->topicParticipations[] = $topicParticipant;
            $topicParticipant->setUserGroup($this);
        }

        return $this;
    }

    public function removeTopicParticipation(TopicParticipation $topicParticipant): self
    {
        if ($this->topicParticipations->removeElement($topicParticipant)) {
            // set the owning side to null (unless already changed)
            if ($topicParticipant->getUserGroup() === $this) {
                $topicParticipant->setUserGroup(null);
            }
        }

        return $this;
    }
}
