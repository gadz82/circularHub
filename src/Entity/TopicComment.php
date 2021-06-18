<?php

namespace App\Entity;

use App\Repository\TopicCommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TopicCommentRepository::class)
 */
class TopicComment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="topicComments")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Topic::class, inversedBy="topicComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $topic;

    /**
     * @ORM\OneToMany(targetEntity=TopicCommentAttachment::class, mappedBy="topicComment", orphanRemoval=true)
     */
    private $topicCommentAttachments;

    public function __construct()
    {
        $this->topicCommentAttachments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return User|null
     */
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
     * @return Topic|null
     */
    public function getTopic(): ?Topic
    {
        return $this->topic;
    }

    /**
     * @param Topic|null $topic
     * @return $this
     */
    public function setTopic(?Topic $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * @return Collection|TopicCommentAttachment[]
     */
    public function getTopicCommentAttachments(): Collection
    {
        return $this->topicCommentAttachments;
    }

    public function addTopicCommentAttachment(TopicCommentAttachment $topicCommentAttachment): self
    {
        if (!$this->topicCommentAttachments->contains($topicCommentAttachment)) {
            $this->topicCommentAttachments[] = $topicCommentAttachment;
            $topicCommentAttachment->setTopicComment($this);
        }

        return $this;
    }

    public function removeTopicCommentAttachment(TopicCommentAttachment $topicCommentAttachment): self
    {
        if ($this->topicCommentAttachments->removeElement($topicCommentAttachment)) {
            // set the owning side to null (unless already changed)
            if ($topicCommentAttachment->getTopicComment() === $this) {
                $topicCommentAttachment->setTopicComment(null);
            }
        }

        return $this;
    }
}
