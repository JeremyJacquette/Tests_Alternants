<?php

class DrinkExpense
{
    private float $amount;

    private $description;

    private \DateTime $happenedAt;

    private User $le_payeur;

    /**
     * @var array<User>
     */
    private array $participants;

    /**
     * @param array <string, User> $participants
     */
    public function __construct(float $amount, string $description, DateTime $happenedAt, User $le_payeur, array $participants)
    {
        $this->amount = $amount;
        $this->description = $description;
        $this->happenedAt = $happenedAt;
        $this->le_payeur = $le_payeur;
        $this->participants = $participants;
    }
     //that function is used for the balance
     public function getUnitaryShared(): float
     {
         $totalParticipants = count($this->participants);
         
         return ($totalParticipants > 0) ? ($this->amount / $totalParticipants) : 0;
     }

    
    //this is used for the balance between users
    public function getUserShare(User $user): float
{
    $totalParticipants = count($this->participants);
    
    return ($totalParticipants > 0 && in_array($user, $this->participants)) ? ($this->amount / $totalParticipants) : 0;
}


    /**
     * @return array<string, User> $participants
     */
    public function getParticipants(): array
    {
        return $this->participants;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getHappenedAt(): \DateTime
    {
        return $this->happenedAt;
    }

    public function getPayer(): User
    {
        return $this->le_payeur;
    }

    function getType() {
        return 'DRINK';
    }
}