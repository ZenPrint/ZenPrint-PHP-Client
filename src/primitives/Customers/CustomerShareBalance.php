<?php

use RESTful\RESTful;
use Assert\Assertion;

Class CustomerShareBalance
{
    private $shareToUser = null;
    private $creditsToShare = null;
    private $comment = null;

    function __construct() 
    {

    }

    public function getShareToUser() {
        return $this->shareToUser;
    }

    public function setShareToUser($shareToUser) {
        if (preg_match('/@/', $shareToUser)) {
            Assertion::email($shareToUser);
        } else {
            Assertion::integer($shareToUser);
        }
        $this->shareToUser = $shareToUser;
    }

    public function getCreditsToShare() {
        return $this->creditsToShare;
    }

    public function setCreditsToShare($creditsToShare) {
        Assertion::integer($creditsToShare);
        Assertion::min($creditsToShare, 0);
        $this->creditsToShare = $creditsToShare;
    }

    public function getComment() {
        return $this->comment;
    }

    public function setComment($comment) {
        Assertion::string($comment);
        Assertion::notEmpty($comment);
        $this->comment = $comment;
    }

    public function toJson() {
        return json_encode (
            $this->toArray()
        );
    }

    public function toArray() {
        return array (
            'share_to_user' => $this->getShareToUser(),
            'credits_to_share' => $this->getCreditsToShare(),
            'comment' => $this->getComment()
        );
    }

    public function restValidation() {
        Assertion::notNull($this->getShareToUser());
        Assertion::notNull($this->getCreditsToShare());
    }
}
