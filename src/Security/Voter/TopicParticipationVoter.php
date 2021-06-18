<?php

namespace App\Security\Voter;

use App\Entity\Topic;
use App\Entity\User;
use App\Repository\TopicParticipationRepository;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class TopicParticipationVoter extends Voter
{
    public const READ = 'read';
    public const PARTICIPATE = 'participate';

    /**
     * @var TopicParticipationRepository
     */
    private $topicParticipantRepository;

    public function __construct(TopicParticipationRepository $topicParticipantRepository)
    {
        $this->topicParticipantRepository = $topicParticipantRepository;
    }

    protected function supports(string $attribute, $subject): bool
    {

        return in_array($attribute, [self::PARTICIPATE, self::READ])
            && $subject instanceof Topic;
    }


    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        /** @var User $user */
        $user = $token->getUser();

        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) return false;

        if(empty($groups = $user->getGroups())) return false;

        $topicParticipations = $this->topicParticipantRepository->findBy(['topic' => $subject->getId()]);

        foreach($topicParticipations as $topicParticipation){
            if($groups->contains($topicParticipation->getUserGroup()) && $topicParticipation->getRole() == $attribute) return true;
        }

        return false;
    }
}
