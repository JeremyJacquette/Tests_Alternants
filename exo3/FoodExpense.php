<?php

class FoodExpense
{
    private float $amount;

    private $description;

    private \DateTime $happenedAt;

    private User $thePayer;

    /**
     * @var array<User>
     */
    private array $participants;

    /**
     * @param array <string, User> $participants
     */
    public function __construct(float $amount, string $description, DateTime $happenedAt, User $thePayer, array $participants)
    {
        $this->amount = $amount;
        $this->description = $description;
        $this->happenedAt = $happenedAt;
        $this->thePayer = $thePayer;
        $this->participants = $participants;
    }
  
    /**
     * I used here the same function as the DrinkExpense because it's the same logic
     * I used ternary for lisibility
     * @return float
     */
    public function getUnitaryShared(): float
    {  
         //this count the number of participants
        $totalParticipants = count($this->participants);
        //this return the amount of the expense divided by the number of participants
        return ($totalParticipants > 0) ? ($this->amount / $totalParticipants) : 0;
    }

    /**
     * I used here the same function as the DrinkExpense because it's the same logic
     * I used ternary for lisibility 
     * @param User $user
     * @return float
     */
     public function getUserShare(User $user): float
     {  
        //this count the number of participants
         $amountOfParticipants = count($this->participants);
         //this return the amount of the expense divided by the number of participants
         return ($amountOfParticipants > 0 && in_array($user, $this->participants)) ? ($this->amount / $amountOfParticipants) : 0;
     }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return \DateTime
     */
    public function getHappenedAt(): \DateTime
    {
        return $this->happenedAt;
    }

    /**
     * @return User
     */
    public function getPayer(): User
    {
        return $this->thePayer;
    }

    /**
     * @return array<string, User> $participants
     */
    public function getParticipants(): array
    {
        return $this->participants;
    }

    /**
     * @return void
     */
    function getType() {
        return 'FOOD';
    }
}