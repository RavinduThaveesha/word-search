<?php 

class WordSearch {

	//characters array
	private $grid;

	//characters string
	public $string;

	//search words
	public $word;

	//all occurrence
	public $positions;

	/**
	*
	* @method private
	* set string into multi dimenssional array.
	* @return mixed
	*
	**/
	private function setArray()
	{
		$characters = explode('|', $this->string);

		//characters into multi dimensional array
		foreach ($characters as $character) 
		{
			//split characters and add into grid
			$this->grid[] = str_split($character);
		}

		return $this->grid;
	}

	/**
	*
	* @method public
	* main function.
	* @return mixed
	*
	**/
	public function run()
	{
		$objc = $this;

		$grid = (empty($this->grid)) ? $this->setArray() : $this->grid;

		$word = str_split($this->word);

		//loop through rows
		for ($row = 0; $row < count($this->grid); $row++)
		{
			//loop through columns
		    for($col = 0; $col < count($this->grid[0]); $col++)
		    {
		    	if($result = $this->search($grid, $row, $col, $word))
		    		$this->positions[] = $result;
		    }
		}

		return $objc;
	}

	/**
	*
	* @method private
	* search 8 direction on grid.
	* @return mixed
	*
	**/
	private function search($grid, $row, $col, $word)
	{
	    $x = [ -1, -1, -1, 0, 0, 1, 1, 1 ];
	    $y = [ -1, 0, 1, -1, 1, -1, 0, 1 ];

	    if($grid[$row][$col] != $word[0])
	    {
	        return false;
	    } 

	    for ($dir = 0; $dir < 8; $dir++)
	    {
	       
	        $position[] = [$row, $col];

	        $rd = $row + $x[$dir];
	        $cd = $col + $y[$dir];

	        for ($char = 1; $char < count($word); $char++)
	        {
	            if ($rd >= count($grid) || $rd < 0 || $cd >=  count($grid[0]) || $cd < 0)
	                break;
	            
	            if ($grid[$rd][$cd] != $word[$char])
	            	break;

	            array_push($position, [$rd, $cd]);

	            $rd += $x[$dir];
	            $cd += $y[$dir];
	        }

	        if($char == count($word))
         		return $position;

         	unset($position);
	    }

	    return false;
	}

	/**
	*
	* @method public
	* print grid into array.
	*
	**/
	public function grid()
	{
		$grid = $this->setArray();
		$this->debug($grid);
	}

	/**
	*
	* @method public
	* print result into array.
	*
	**/
	public function result()
	{
		$this->debug($this->positions);
	}

	/**
	*
	* @method public
	* display grid in html view.
	*
	**/
	public function gridHtml()
	{
		$grid = $this->setArray();

		$html = '';

		$html .= '<table>';

		for ($row = 0; $row < count($grid); $row++)
		{
			$html .= '<tr>';

		    for($col = 0; $col < count($grid[0]); $col++)
		    {
		    	$html .= '<td>';
		    	
			    $html .= $grid[$row][$col];
			    
			    $html .= '</td>';
		    }

		    $html .= '</tr>';
		}

		$html .= '</table>';

		return $html;
	}

	/**
	*
	* @method public
	* display result grid in html view.
	*
	**/
	public function resultHtml()
	{
		$results = [];
		foreach ($this->positions as $position) 
		{
			$results = array_merge($results, $position);
		}

		$html = '';

		$html .= '<table>';

		for ($row = 0; $row < count($this->grid); $row++)
		{
			$html .= '<tr>';

		    for($col = 0; $col < count($this->grid[0]); $col++)
		    {
		    	$html .= '<td>';
		    	$hasValue = false;

		    	foreach ($results as $result) 
		    	{
		    		if ($result[0] == $row && $result[1] == $col)
		    			$hasValue = true;
		    	}

		    	if($hasValue) 
		    	{
		    		$html .= '<span style="color:red">' . $this->grid[$row][$col] . '</span>';
		    	} else {
		    		$html .= $this->grid[$row][$col];
		    	}
			    
			    
			    $html .= '</td>';
		    }

		    $html .= '</tr>';
		}

		$html .= '</table>';

		return $html;

	}

	/**
	*
	* @method private
	* only for developing purposes.
	*
	**/
	private function debug($parms)
	{
		echo '<pre>'; print_r($parms); echo '</pre>';
	}
}
