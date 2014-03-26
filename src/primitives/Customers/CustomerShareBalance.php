<?php

use RESTful\RESTful;
use Assert\Assertion;

Class CustomerShareBalance
{
    private $shareToUserId = null;
    private $creditsToShare = null;
    private $comment = null;

    function __construct() 
    {

    }

    public function getShareToUser() {
        return $this->shareToUserId;
    }

    public function setShareToUser($shareToUserId) {
        Assertion::integer($shareToUserId);
        $this->shareToUserId = $shareToUserId;
    }

    public function getCreditsToShare() {
        return $this->creditsToShare;
    }

    public function setCreditsToShare($creditsToShare) {
        //Assertion::min($creditsToShare, 0);
        Assertion::float($creditsToShare);
        $this->creditsToShare = $creditsToShare;
    }

    public function getComment() {
        return $this->comment;
    }

    public function setComment($comment) {
        Assertion::string($comment);
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
}
