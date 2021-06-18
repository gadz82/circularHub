<?php

namespace App\Entity;

use App\Repository\TopicRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TopicRepository::class)
 */
class Topic
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $closesAt;

    /**
     * @ORM\Column(type="json")
     */
    private $type = [];

    /**
     * @ORM\OneToMany(targetEntity=Group::class, mappedBy="topic")
     */
    private $groups;

    /**
     * @ORM\OneToMany(targetEntity=TopicComment::class, mappedBy="topic", orphanRemoval=true)
     */
    private $topicComments;

    /**
     * @ORM\OneToMany(targetEntity=TopicParticipation::class, mappedBy="topic", orphanRemoval=true)
     */
    private $topicParticipations;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->topicComments = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getClosesAt(): ?DateTimeInterface
    {
        return $this->closesAt;
    }

    public function setClosesAt(?DateTimeInterface $closesAt): self
    {
        $this->closesAt = $closesAt;

        return $this;
    }

    public function getType(): ?array
    {
        return $this->type;
    }

    public function setType(array $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Group[]
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(Group $group): self
    {
        if (!$this->groups->contains($group)) {
            $this->groups[] = $group;
        }

        return $this;
    }

    /**
     * @return Collection|TopicComment[]
     */
    public function getTopicComments(): Collection
    {
        return $this->topicComments;
    }

    public function addTopicComment(TopicComment $topicComment): self
    {
        if (!$this->topicComments->contains($topicComment)) {
            $this->topicComments[] = $topicComment;
            $topicComment->setTopic($this);
        }

        return $this;
    }

    public function removeTopicComment(TopicComment $topicComment): self
    {
        if ($this->topicComments->removeElement($topicComment)) {
            // set the owning side to null (unless already changed)
            if ($topicComment->getTopic() === $this) {
                $topicComment->setTopic(null);
            }
        }

        return $this;
    }

    public function __toString() : string
    {
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
            $topicParticipant->setTopic($this);
        }

        return $this;
    }

    public function removeTopicParticipation(TopicParticipation $topicParticipant): self
    {
        if ($this->topicParticipations->removeElement($topicParticipant)) {
            // set the owning side to null (unless already changed)
            if ($topicParticipant->getTopic() === $this) {
                $topicParticipant->setTopic(null);
            }
        }

        return $this;
    }
}
