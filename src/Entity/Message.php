<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message", indexes={@ORM\Index(name="fk_message_user1_idx", columns={"user_form"}), @ORM\Index(name="fk_message_user2_idx", columns={"user_to"})})
 * @ORM\Entity
 */
class Message
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255, nullable=false)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="string", length=255, nullable=false)
     */
    private $createdAt;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_form", referencedColumnName="id")
     * })
     */
    private $userForm;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_to", referencedColumnName="id")
     * })
     */
    private $userTo;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Message
     */
    public function setContent(string $content): Message
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     * @return Message
     */
    public function setCreatedAt(string $createdAt): Message
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return User
     */
    public function getUserForm(): User
    {
        return $this->userForm;
    }

    /**
     * @param User $userForm
     * @return Message
     */
    public function setUserForm(User $userForm): Message
    {
        $this->userForm = $userForm;
        return $this;
    }

    /**
     * @return User
     */
    public function getUserTo(): User
    {
        return $this->userTo;
    }

    /**
     * @param User $userTo
     * @return Message
     */
    public function setUserTo(User $userTo): Message
    {
        $this->userTo = $userTo;
        return $this;
    }


}
