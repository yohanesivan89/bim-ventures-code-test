<?php

    function getTrxStatus($outstanding_amount, $duedate)
    {
        $status = 'Outstanding';

        $dueDate = is_string($duedate) ? new \DateTime($duedate) : $duedate;

        // Get today's date
        $today = \Illuminate\Support\Carbon::now()->subDays(1);
        
        // Compare due date with today's date
        if($dueDate <= $today)
        {
            $status = 'Overdue';
        }

        if($outstanding_amount == 0)
        {
            $status = 'Paid';
        }

        return $status;
    }
?>