<?php

namespace App\Entity;

use App\Repository\AddressBookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AddressBookRepository::class)
 */
class AddressBook
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=AddressBookEntry::class, mappedBy="addressBook", orphanRemoval=true)
     */
    private $addressBookEntries;

    public function __construct()
    {
        $this->addressBookEntries = new ArrayCollection();
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|AddressBookEntry[]
     */
    public function getAddressBookEntries(): Collection
    {
        return $this->addressBookEntries;
    }

    public function addAddressBookEntry(AddressBookEntry $addressBookEntry): self
    {
        if (!$this->addressBookEntries->contains($addressBookEntry)) {
            $this->addressBookEntries[] = $addressBookEntry;
            $addressBookEntry->setAddressBook($this);
        }

        return $this;
    }

    public function removeAddressBookEntry(AddressBookEntry $addressBookEntry): self
    {
        if ($this->addressBookEntries->removeElement($addressBookEntry)) {
            // set the owning side to null (unless already changed)
            if ($addressBookEntry->getAddressBook() === $this) {
                $addressBookEntry->setAddressBook(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->getId()." - ".$this->getTitle();
    }
}
