<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
class Subject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $subjectNo;

    #[ORM\Column(type: 'integer')]
    private $subjectSlots;

    #[ORM\OneToMany(mappedBy: 'subject', targetEntity: Room::class)]
    private $rooms;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
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

    public function getSubjectNo(): ?string
    {
        return $this->subjectNo;
    }

    public function setSubjectNo(string $subjectNo): self
    {
        $this->subjectNo = $subjectNo;

        return $this;
    }

    public function getSubjectSlots(): ?int
    {
        return $this->subjectSlots;
    }

    public function setSubjectSlots(int $subjectSlots): self
    {
        $this->subjectSlots = $subjectSlots;

        return $this;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->setSubject($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getSubject() === $this) {
                $room->setSubject(null);
            }
        }

        return $this;
    }
}
